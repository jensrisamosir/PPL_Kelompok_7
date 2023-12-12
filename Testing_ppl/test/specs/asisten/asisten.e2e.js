const { expect } = require('@wdio/globals');
const LoginPage = require('../../pageobjects/login.page');

const AsistenPage = require('../../pageobjects/asisten.page');

describe('tambah data asisten ', () => {
    it('should login with valid credentials', async () => {
        await LoginPage.open();

        await LoginPage.login('williamstmrg31@gmail.com', 'flora123');

        // Tunggu hingga URL sesuai dengan yang diharapkan setelah login
        await browser.waitUntil(async () => {
            const currentUrl = await browser.getUrl();
            return currentUrl === 'http://127.0.0.1:8001/dokter';
        });

        // Verifikasi URL setelah login
        const currentUrl = await browser.getUrl();
        expect(currentUrl).toBe('http://127.0.0.1:8001/dokter');
    });
    
    it('harus mengisi data asisten dengan benar', async () => {
        // Navigate to your application's URL
        await AsistenPage.open()
        await AsistenPage.asisten('Jensrii','jensrii@gmail.com', 'jensri1234','jensri1234', 'Asisten')
    
        const alert = $('.alert-success');
        await alert.waitForDisplayed();
        await expect(alert).toBeDisplayed();
       
    });
    it('mengisi nama dengan angka', async () => {
        // Navigate to your application's URL
        await AsistenPage.open()
        await AsistenPage.asisten('12345','jensrii@gmail.com', 'jensri1234','jensri1234', 'Asisten')

        const alert = $('.alert-success');
        await expect(alert).not.toBeDisplayed();
    });
    it('mengisi email dengan alamat yang tidak valid', async () => {
        await AsistenPage.open()
        await AsistenPage.asisten('Jensriii','jensrii', 'jensri1234','jensri1234', 'Asisten')
    
        
        const alert = $('.alert-success');
        await expect(alert).not.toBeDisplayed();
    });
    it('mengisi email dengan format yang tidak benar', async () => {
        await AsistenPage.open()
        await AsistenPage.asisten('Jens','jensrii@gmail.com.com', 'jensri1234','jensri1234', 'Asisten')
    
        const alert = $('.alert-success');
        await expect(alert).not.toBeDisplayed();
    
    });
    it('memasukkan konfirmasi password yang tidak sama dengan password', async () => {
        await AsistenPage.open()
        await AsistenPage.asisten('Jensriiii','jensrii@gmail.com', 'jensri1234','jensri1234', 'Asisten')
    
        
        const alert = $('.alert-success');
        await expect(alert).not.toBeDisplayed();
    });
    it('nama dikosongkan', async () => {
        await AsistenPage.open()
        await AsistenPage.asisten('','jensrii@gmail.com', 'jensri1234','jensri1234', 'Asisten')
    
        // Wait for success message to be displayed
        // Verifikasi bahwa pesan sukses muncul
        const alert = $('.alert-success');
        await expect(alert).not.toBeDisplayed();
    });
    it('email dikosongkan', async () => {
        await AsistenPage.open()
        await AsistenPage.asisten('Jensrii','', 'jensri1234','jensri1234', 'Asisten')
    
        // Wait for success message to be displayed
        // Verifikasi bahwa pesan sukses muncul
        const alert = $('.alert-success');
        await expect(alert).not.toBeDisplayed();
    });
    it('password dikosongkan', async () => {
        await AsistenPage.open()
        await AsistenPage.asisten('Jensrii','jensrii@gmail.com', '','jensri1234', 'Asisten')
    
        
        // Wait for success message to be displayed
        // Verifikasi bahwa pesan sukses muncul
        const alert = $('.alert-success');
        await expect(alert).not.toBeDisplayed();
    });
    it('Konfirmasi password dikosongkan', async () => {
        await AsistenPage.open()
        await AsistenPage.asisten('Jensrii','jensrii@gmail.com', 'jensri1234','', 'Asisten')
    
        // Wait for success message to be displayed
        // Verifikasi bahwa pesan sukses muncul
        const alert = $('.alert-success');
        await expect(alert).not.toBeDisplayed();
    });
      
});