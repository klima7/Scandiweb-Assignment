import React from 'react';
import ReactDOM from 'react-dom/client';
import { RouterProvider, createBrowserRouter } from "react-router-dom";

import Add from "./add/index";
import List from "./list/index";

const root = ReactDOM.createRoot(document.getElementById('root'));

const router = createBrowserRouter([
  {
    path: "/",
    element: <List />,
  },
  {
    path: "/add",
    element: <Add />,
  },
  {
    path: "*",
    element: <>Page Not Found</>,
  },
]);

root.render(
  <React.StrictMode>
    <RouterProvider router={router} />
  </React.StrictMode>
);
