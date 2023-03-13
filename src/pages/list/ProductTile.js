import Card from "react-bootstrap/Card";
import Form from "react-bootstrap/Form";

function ProductTile({ product }) {
  return (
    <Card
      bg="light"
      key="light"
      text="dark"
      style={{ width: "100%" }}
      className="mb-2"
    >
      <Card.Header>
        <Form.Check type="checkbox" label='' />
      </Card.Header>
      <Card.Body style={{'padding': 0}}>
        <Card.Text>
          <ul style={{'text-align': 'center', 'padding-left': 0}}>
            <li style={{'display': 'block', 'list-style-type': 'none'}}>{product.id}</li>
            <li style={{'display': 'block', 'list-style-type': 'none'}}>{product.name}</li>
            <li style={{'display': 'block', 'list-style-type': 'none'}}>{product.price} $</li>
            <li style={{'display': 'block', 'list-style-type': 'none'}}>{getProductSpecificText(product)}</li>
          </ul>
        </Card.Text>
      </Card.Body>
    </Card>
  );
}

function getProductSpecificText(product) {
    switch(product.type) {
        case 'book':
            return `Weight: ${product.weight}`;
        case 'disc':
            return `Size: ${product.size} MB`;
        case 'furniture':
            return `Dimension: ${product.height}x${product.width}x${product.length}`;
        default:
            return '';
    }
}

export default ProductTile;
