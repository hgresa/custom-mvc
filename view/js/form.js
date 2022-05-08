class Form
{
    constructor(formName = null) {
        this.formName = formName
    }

    handleSave(event)
    {
        event.preventDefault()

        let form = $(`#${this.formName}`)
        let form_data = form.serializeArray()
        let result = this.sendSaveRequest(form_data)

        if (result === true) {
            this.displaySuccessMessage()
        } else {
            this.displayValidationMessages(result)
        }
    }

    handleDelete(element)
    {
        let entryId = element.attr('value')
        let result = this.sendDeleteRequest(entryId)

        if (result === true) {
            let rowElement = $(`#row-${entryId}`)
            rowElement.remove()
        }
    }

    sendSaveRequest(form_data)
    {
        let result = false;

        $.post({
            async: false,
            url: '/save_form_entry',
            data: form_data
        }).done(function (response) {
            if (response == 1) {
                result = true;
            } else {
                result = JSON.parse(response);
            }
        })

        return result;
    }

    sendDeleteRequest(id)
    {
        let result = false;

        $.post({
            async: false,
            url: '/delete_form_entry',
            data: {'id': id},
        }).done(function (response) {
            if (response == 1) {
                result = true;
            }
        })

        return result;
    }

    clearValidationMessages()
    {
        $(`#${this.formName} span`).each(function () {
            let span = $(this)
            span.empty()
        })
    }

    displaySuccessMessage()
    {
        this.clearValidationMessages()
        let messageElement = $('#success_message').show()

        messageElement.text('Your record has been saved successfully')
        messageElement.show()
    }

    displayValidationMessages(messages)
    {
        this.clearValidationMessages()
        for (let key in messages) {
            let value = messages[key]
            let spanField = $(`#${key}_error`)
            spanField.text(value)
        }
    }
}
