import { Fragment } from "react";
import Button from "react-bootstrap/Button";
import Header from "../../components/Header.js";
import { useNavigate } from "react-router-dom";

function AddPage() {
  const navigate = useNavigate(); 

  function onCancelClick() {
    navigate('/');
  }

  return (
    <Fragment>
      <Header>
        <Button variant="success">Save</Button>{" "}
        <Button variant="danger" onClick={onCancelClick}>Cancel</Button>
      </Header>
      <div className="App"></div>
    </Fragment>
  );
}

export default AddPage;
