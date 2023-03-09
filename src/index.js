import React from 'react';
import ReactDOM from 'react-dom/client';
import { RouterProvider, createBrowserRouter } from "react-router-dom";

import ListPage from "./pages/list/index";
import AddPage from "./pages/add/index";

const root = ReactDOM.createRoot(document.getElementById('root'));

const router = createBrowserRouter([
  {
    path: "/",
    element: <ListPage />,
  },
  {
    path: "/add",
    element: <AddPage />,
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
