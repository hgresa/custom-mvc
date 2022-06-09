<?php

namespace app\models;

class FormModel extends BaseModel
{
    public string $tableName = 'form';
    public int $id;
    public string $name;
    public string $surname;
    public string $email;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $surname
     * @return void
     */
    public function setSurname(string $surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $email
     * @return void
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param $postData
     * @return void
     */
    public function insertEntry($postData) {
        $name = $postData['first_name'];
        $surname = $postData['last_name'];
        $email = $postData['email'];

        $this->setName($name);
        $this->setSurname($surname);
        $this->setEmail($email);

        $this->save();
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteEntry(int $id)
    {
        $this->delete($id);
    }

    /**
     * @return array
     */
    public function getCollection(): array
    {
        return array_reverse($this->loadCollection());
    }
}
