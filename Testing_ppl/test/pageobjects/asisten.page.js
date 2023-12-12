const { $ } = require('@wdio/globals')
const Page = require('./page');

/**
 * sub page containing specific selectors and methods for a specific page
 */
class AsistenPage extends Page {
    get asistenInput() {
        return $('#name');
    }

    get emailInput() {
        return $('#email');
    }

    get passwordInput() {
        return $('#password');
    }

    get konfirmasiInput() {
        return $('[name="password_confirmation"]');
    }

    get roleDropdown() {
        return $('#role_id');
    }

    get btnSubmit() {
        return $('button.btn-success');
    }

    async asisten(name, email, password, password_confirmation, role_id) {
        await this.asistenInput.setValue(name);
        await this.emailInput.setValue(email);
        await this.passwordInput.setValue(password);
        await this.konfirmasiInput.setValue(password_confirmation);
        await (await this.roleDropdown).selectByVisibleText(role_id);

        await this.btnSubmit.click();
    }

    open() {
        return super.open('createAsisten');
    }
}

module.exports = new AsistenPage();
