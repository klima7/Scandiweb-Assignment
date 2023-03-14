import { Fragment } from "react";
import Button from "react-bootstrap/Button";
import Header from "../../components/Header.js";

function AddPage() {
  return (
    <Fragment>
      <Header>
        <Button variant="success">Save</Button>{" "}
        <Button variant="danger">Cancel</Button>
      </Header>
      <div className="App"></div>
    </Fragment>
  );
}

export default AddPage;
