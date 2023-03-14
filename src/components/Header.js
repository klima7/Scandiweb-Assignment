function Header({ children }) {
  return (
    <div class="p-2">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h1>Product List</h1>
        </div>
        <div>
          {children}
        </div>
      </div>
      <hr style={{'border': '3px solid black', 'border-radius': 5}} />
    </div>
  );
}

export default Header;
