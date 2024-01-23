import React, { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import "./styles.css";

import Tuto from "./Tuto.react";

const root = createRoot(document.getElementById("root"));
root.render(
  <StrictMode>
    <Tuto />
  </StrictMode>
);