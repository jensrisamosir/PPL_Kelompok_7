

const axios = require('axios');

describe('WebdriverIO with API DELETE Request', () => {
    it('should make a DELETE request to the API', async () => {
        try {
            // Make a DELETE request using axios
            const response = await axios.delete('http://127.0.0.1:8000/api/patient/44');

            // Log the API response to the console
            console.log('API DELETE Response:', response.data);

            // No need for additional WebdriverIO actions here

            // Add your assertions and further test logic here

        } catch (error) {
            // Handle errors, including non-2xx responses
            console.error('Error:', error.message);
            throw error;
        }
    });
});

