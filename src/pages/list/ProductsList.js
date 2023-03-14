import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import ProductTile from "./ProductTile.js";

function ProductList({ products, selected, onSelectedChange }) {

  function updateSelected(product, checked) {
    console.log(product, checked)
    let newSelected = Array.from(selected);
    if(checked) {
      newSelected.push(product)
    } else {
      newSelected.splice(newSelected.indexOf(product), 1)
    }
    console.log(newSelected)
    onSelectedChange(newSelected)
  }

  return (
    <Container fluid>
          <Row>
            {products.map((product) => (
              <Col xxs={12} sm={6} md={4} lg={3} xxl={2}>
                <ProductTile product={product} selected={selected.includes(product)} onSelectedChange={updateSelected}/>
              </Col>
            ))}
          </Row>
      </Container>
  );
}

export default ProductList;
