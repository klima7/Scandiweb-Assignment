import { Fragment, useEffect, useState } from "react";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import Button from 'react-bootstrap/Button';
import { useNavigate } from "react-router-dom";

import ProductsList from "./ProductsList.js";
import Header from "../../components/Header.js";
import Api from "../../api.js";

function ListPage() {
  const [products, setProducts] = useState([]);
  const [selected, setSelected] = useState([]);
  const navigate = useNavigate(); 

  async function fetchProducts() {
    let allProducts = await Api.getAllProducts();
    setProducts(allProducts);
  };

  function onAddClick() {
    navigate('/add');
  }

  async function onMassDeleteClick() {
    await Api.deleteProducts(selected);
    await fetchProducts();
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
      <ProductsList products={products} selected={selected} onSelectedChange={(newSelected)=>setSelected(newSelected)} />
    </Fragment>
  );
}

export default ListPage;
