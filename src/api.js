import jquery from 'jquery';

class Api {

    static getAllProducts() {
        return new Promise((resolve, reject) => {
            jquery.get('api/products.php', (data, status) => {
                if (status === 'success') {
                    resolve(data);
                } else {
                    reject(new Error('API call failed'))
                }
              });
        })
    }

    static async addProduct(product) {

    }

    static async deleteProducts(products) {
        return new Promise((resolve, reject) => {
            let data = {ids: products.map(product => product.id)};
            console.log(data);
            jquery.ajax({
                url: 'api/products.php',
                method: 'DELETE',
                contentType: 'application/json',
                data: JSON.stringify(data),
                complete: (data, status) => {
                    console.log(status);
                    if (status === 'nocontent') {
                        resolve();
                    } else {
                        reject(new Error('API call failed'))
                    }
                  },
                dataType: 'json'
            })
        })
    }

}

export default Api;
 