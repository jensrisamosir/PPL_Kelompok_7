

const axios = require('axios');

describe('API Testing', () => {
    it('should make a POST request to the API', async () => {
        try {
            const postData = {
                name: 'Jensrijs',
                email: 'jens@gmail.com',
                password: 'jens1234',
                password_confirm: 'jens1234',
                role_id: '2'
            };

            console.log('Sending POST request to the API...');
            
            const response = await axios.post('http://127.0.0.1:8000/api/createAsisten', postData);

            // Perform assertions based on the response, if needed
            console.log('Response Status:', response.status);
            console.log('Response Data:', response.data);

            // If the status is not 2xx, consider it a failure
            if (response.status >= 300) {
                throw new Error(`Request failed with status code ${response.status}`);
            }
        } catch (error) {
            console.error('Error:', error.message);
            throw error;
        }
    });
});
