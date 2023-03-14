import { Fragment, useEffect, useState } from "react";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import Button from 'react-bootstrap/Button';
import { useNavigate } from "react-router-dom";

import ProductTile from "./ProductTile.js";
import Header from "../../components/Header.js";
import Api from "../../api.js";

function ListPage() {
  const [products, setProducts] = useState([]);
  const navigate = useNavigate(); 

  async function fetchProducts() {
    let allProducts = await Api.getAllProducts();
    console.log(allProducts);
    setProducts(allProducts);
  };

  function onAddClick() {
    navigate('/add');
  }

  function onMassDeleteClick() {

  }

  useEffect(() => {
    fetchProducts();
  }, []);

  return (
    <Fragment>
      <Header>
        <Button variant="success" onClick={onAddClick}>Add</Button>{' '}
        <Button variant="danger" onClick={onMassDeleteClick}>Mass Delete</Button>
      </Header>
      <div className="App">
        <Container fluid>
          <Row>
            {products.map((product) => (
              <Col xxs={12} sm={6} md={4} lg={3} xxl={2}>
                <ProductTile product={product} />
              </Col>
            ))}
          </Row>
        </Container>
      </div>
    </Fragment>
  );
}

export default ListPage;
