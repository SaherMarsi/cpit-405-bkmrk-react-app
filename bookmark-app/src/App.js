import React from "react";
import Create from "./components/Create";
import ReadAll from "./components/ReadAll"
import ReadOne from "./components/ReadOne"
import Update from "./components/Update"
import Delete from "./components/Delete"
import "./App.css"

function App() {
  return (
    <div className="App">
      <Create />
      <ReadAll/>
      <ReadOne/>
      <Update />
      <Delete />
    </div>
  );
}

export default App;
