import { Fragment } from 'react';
import Button from 'react-bootstrap/Button';
import jquery from 'jquery';

function ListPage() {
  jquery.get('api/products.php', (data, status) => {
    console.log(status);
    console.log(data);
  });
  return (
    <Fragment>
    <div className="App">
      List Page
      <Button variant="primary">Button</Button>
    </div>
    </Fragment>
  );
}

export default ListPage;
