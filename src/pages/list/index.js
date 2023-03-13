import { Fragment, useEffect, useState } from "react";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";

import ProductTile from "./ProductTile.js";
import Api from "../../api.js";

function ListPage() {
  const [products, setProducts] = useState([]);

  const fetchProducts = async () => {
    console.log("fetchProducts");
    let allProducts = await Api.getAllProducts();
    console.log(allProducts);
    setProducts(allProducts);
  };

  useEffect(() => {
    fetchProducts();
  }, []);

  return (
    <Fragment>
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
