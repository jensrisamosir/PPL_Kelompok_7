const axios = require('axios');
const assert = require('assert');

describe('WebdriverIO with API Request', () => {
    it('should make a GET request to the API', async () => {
        try {
            // Make an API request using axios
            const response = await axios.get('http://127.0.0.1:8000/api/patient');

            // Log the API response to the console
            console.log('API Response:', response.data);

            
            assert.strictEqual(response.status, 200);

        } catch (error) {
            console.error('Error:', error.message);
            throw error;
        }
    });
});
