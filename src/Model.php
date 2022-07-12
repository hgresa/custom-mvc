<?php

namespace app\src;

use \PDO;

class Model extends Database
{
    /**
     * @return void
     */
    public function save(): void
    {
        $properties = $this->getProperties();
        $tableName = $this->getTableName();
        $columns = implode(', ', array_keys($properties));
        $values = array_values($properties);
        $placeholders = substr(str_repeat('?, ', count($properties)), 0, -2);

        $sql = "INSERT INTO $tableName($columns) VALUES($placeholders)";
        $statement = $this->prepare($sql);
        $statement->execute($values);
    }

    /**
     * @param $id
     * @return void
     */
    public function delete($id): void
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM $tableName WHERE id = ?";
        $statement = $this->prepare($sql);
        $statement->execute([$id]);
    }

    public function loadCollection(): Collection
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM $tableName";
        $statement = $this->prepare($sql);
        $statement->execute();

        $fetchedItems = $statement->fetchAll(PDO::FETCH_ASSOC);

        $calledClass = get_called_class();
        $objectCollection = [];
        foreach ($fetchedItems as $item) {
            $object = new $calledClass();

            foreach ($item as $key => $value) {
                $object->$key = $value;
            }

            $objectCollection[] = $object;
        }

        return Collection::make($objectCollection);
   }
}
