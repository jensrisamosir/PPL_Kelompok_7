const { expect } = require('@wdio/globals');
const LoginPage = require('../../pageobjects/login.page');

const ObatPage = require('../../pageobjects/obat.page');

describe('tambah data obat ', () => {
    it('should login with valid credentials', async () => {
        await LoginPage.open();

        await LoginPage.login('william@gmail.com', 'william123');

        // Tunggu hingga URL sesuai dengan yang diharapkan setelah login
        await browser.waitUntil(async () => {
            const currentUrl = await browser.getUrl();
            return currentUrl === 'http://127.0.0.1:8001/asisten';
        });

        // Verifikasi URL setelah login
        const currentUrl = await browser.getUrl();
        expect(currentUrl).toBe('http://127.0.0.1:8001/asisten');
    });
    it('harus mengisi data obat dengan benar', async () => {
        await ObatPage.open()
        await ObatPage.obat('Captopril','cpt', 'Obat hipertensi','06-06-2023', '5', 'Tablet', '5btr')
    
        // Verifikasi bahwa pesan sukses muncul
        const alert = $('.alert-success');
        await alert.waitForDisplayed();
        await expect(alert).toBeDisplayed();

    });
    it('mengisi nama obat dengan integer', async () => {
        await ObatPage.open()
        await ObatPage.obat('12345','cpt', 'Obat hipertensi','06-06-2023', '5', 'Tablet', '5btr')

        const alert = $('.alert-success');
        // await alert.waitForDisplayed();
        await expect(alert).not.toBeDisplayed();
    });
    it('mengisi tanggal yang bukan hari ini', async () => {
        // Navigate to your application's URL
        await browser.url('http://127.0.0.1:8001/obat/create');
    
        // Get input elements
        const obatInput = $('#nama_obat');
        const singkatanInput = $('#singakatan');
        const keteranganInput = $('#keterangan');
        const tanggalInput = $('#tanggal_masuk');
        const jumlahInput = $('#jumlah');
        const kemasanDropdown = $('#kemasan');
        const ukuranObatDropdown = $('#ukuran');
        const btnTambah = $('button.btn-success');
    
        // Set input values
        await obatInput.setValue('Captopril');
        await singkatanInput.setValue('cpt');
        await keteranganInput.setValue('Obat hipertensi');
    
        // Set the tanggalInput to a date in the future
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        const futureDate = tomorrow.toLocaleDateString('id-ID', { month: '2-digit', day: '2-digit', year: 'numeric' });
        await tanggalInput.setValue(futureDate);
    
        await jumlahInput.setValue('5');
        await kemasanDropdown.selectByVisibleText('Tablet');
        await ukuranObatDropdown.selectByVisibleText('5btr');
    
        // Wait for submit button to be clickable
        await btnTambah.waitForExist();
        await btnTambah.waitForClickable();
    
        // Click the submit button
        await btnTambah.click();
    
        // Ensure that the alert for success is not displayed
        const alert = $('.alert-success');
        // await alert.waitForDisplayed();
        await expect(alert).not.toBeDisplayed();

        // Verifikasi bahwa masih berada di halaman yang diharapkan
        const currentUrl = await browser.getUrl();
        expect(currentUrl).toBe('http://127.0.0.1:8001/obat/create');
    });
    it('mengisi singkatan dengan integer', async () => {
        await ObatPage.open()
        await ObatPage.obat('Captopril','123', 'Obat hipertensi','06-06-2023', '5', 'Tablet', '5btr')
    
        // Verifikasi bahwa pesan sukses muncul
        const alert = $('.alert-success');
        await alert.waitForDisplayed();
        await expect(alert).toBeDisplayed();
    });
    it('mengisi keterangan dengan integer', async () => {
        await ObatPage.open()
        await ObatPage.obat('Captopril','cpt', '1234567','06-06-2023', '5', 'Tablet', '5btr')
    
        // Verifikasi bahwa pesan sukses muncul
        const alert = $('.alert-success');
        // await alert.waitForDisplayed();
        await expect(alert).not.toBeDisplayed();
    });
    it('mengisi jumlah input dengan karakter', async () => {
        await ObatPage.open()
        await ObatPage.obat('Captopril','cpt', 'Obat hipertensi','06-06-2023', 'a', 'Tablet', '5btr')
    
        const alert = $('.alert-success');
        await expect(alert).not.toBeDisplayed();        
    });
    it('nama obat dikosongkan', async () => {
        await ObatPage.open()
        await ObatPage.obat('','cpt', 'Obat hipertensi','06-06-2023', '5', 'Tablet', '5btr');
    
        const alert = $('.alert-success');
        await expect(alert).not.toBeDisplayed();
    });
    it('singkatan dikosongkan', async () => {
        await ObatPage.open()
        await ObatPage.obat('Captopril','', 'Obat hipertensi','06-06-2023', '5', 'Tablet', '5btr')
    
        const alert = $('.alert-success');
        await expect(alert).not.toBeDisplayed();
    });
    it('keterangan dikosongkan', async () => {
        await ObatPage.open()
        await ObatPage.obat('Captopril','cpt', '','06-06-2023', '5', 'Tablet', '5btr')
    
        const alert = $('.alert-success');
        // await alert.waitForDisplayed();
        await expect(alert).not.toBeDisplayed();
    });
    it('tanggal masuk dikosongkan', async () => {
        await ObatPage.open()
        await ObatPage.obat('Captopril','cpt', 'Obat hipertensi','', '5', 'Tablet', '5btr')
    
        const alert = $('.alert-success');
        // await alert.waitForDisplayed();
        await expect(alert).not.toBeDisplayed();

    });
    it('jumlah input dikosongkan', async () => {
        await ObatPage.open()
        await ObatPage.obat('Captopril','cpt', 'Obat hipertensi','06-06-2023', '', 'Tablet', '5btr')
    
        const alert = $('.alert-success');
        // await alert.waitForDisplayed();
        await expect(alert).not.toBeDisplayed();
    });
    it('kemasan dikosongkan', async () => {
        await ObatPage.open()
        await ObatPage.obat('Captopril','cpt', 'Obat hipertensi','06-06-2023', '5', 'Pilih Kemasan', 'Pilih Kemasan Terlebih Dahulu')
    
        const alert = $('.alert-success');
        // await alert.waitForDisplayed();
        await expect(alert).not.toBeDisplayed();
    
        
    });
    it('ukuran dikosongkan', async () => {
        await ObatPage.open()
        await ObatPage.obat('Captopril','cpt', 'Obat hipertensi','06-06-2023', '5', 'Tablet', 'Pilih Ukuran Tablet')
    
        
        const alert = $('.alert-success');
        // await alert.waitForDisplayed();
        await expect(alert).not.toBeDisplayed();

    });
});