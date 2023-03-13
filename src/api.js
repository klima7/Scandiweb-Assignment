import jquery from 'jquery';

class Api {

    static getAllProducts() {
        return new Promise((resolve, reject) => {
            jquery.get('api/products.php', (data, status) => {
                if (status === 'success') {
                    resolve(data);
                };
                reject(new Error('API call failed'))
              });
        })
    }

    static async addProduct(product) {

    }

    static async deleteProducts(products) {

    }

}

export default Api;
 