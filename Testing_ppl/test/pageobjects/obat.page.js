const { $ } = require('@wdio/globals')
const Page = require('./page');

/**
 * sub page containing specific selectors and methods for a specific page
 */
class ObatPage extends Page {
    /**
     * define selectors using getter methods
     */
    get obatInput () {
        return $('#nama_obat');
    }

    get singkatanInput () {
        return $('#singakatan');
    }

    get keteranganInput () {
        return $('#keterangan');
    }
    get tanggalInput () {
        return $('#tanggal_masuk');
    }
    get jumlahInput () {
        return $('#jumlah');
    }
    get kemasanDropdown () {
        return $('#kemasan');
    }
    get ukuranObatDropdown () {
        return $('#ukuran');
    }

    get btnTambah () {
        return $('button.btn-success');
    }

    /**
     * a method to encapsule automation code to interact with the page
     * e.g. to login using username and password
     */
    async obat (nama_obat, singakatan, keterangan, tanggal_masuk, jumlah, kemasan, ukuran) {
        await this.obatInput.setValue(nama_obat);
        await this.singkatanInput.setValue(singakatan);
        await this.keteranganInput.setValue(keterangan);
        await this.tanggalInput.setValue(tanggal_masuk);
        await this.jumlahInput.setValue(jumlah);
        await (await this.kemasanDropdown).selectByVisibleText(kemasan);
        await (await this.ukuranObatDropdown).selectByVisibleText(ukuran);
        await this.btnTambah.click();
    }

    /**
     * overwrite specific options to adapt it to page object
     */
    open () {
        return super.open('obat/create');
    }
}

module.exports = new ObatPage();
