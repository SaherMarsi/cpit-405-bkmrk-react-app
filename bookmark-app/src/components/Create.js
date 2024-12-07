import { useState } from "react";

const Create = () => {
  const [title, setTitle] = useState("");
  const [urls, setUrls] = useState("");
  // const API = "http://localhost:3000/api/"; this unfortunately didn't work because of the cors shenanigans

  const handleSubmit = async () => {
    const data = { title, urls };
    try {
      const response = await fetch("/api/create.php", {
        method: "POST",
        // mode:"no-cors", the solution I found online (stackoverflow) was a proxy, in the package.json file
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
      });
      const responseJSON = await response.json();
      console.log(responseJSON.message);
    } catch (error) {
      console.log("Error:", error);
    }
  };

  return (
    <div className="search-container">
      <h1>Create a bookmark!</h1>
      <form onSubmit={handleSubmit}>
        <input
          type="text"
          placeholder="Title"
          value={title}
          onChange={(e) => setTitle(e.target.value)}
          required
        />
        <input
          type="url"
          placeholder="URL"
          value={urls}
          onChange={(e) => setUrls(e.target.value)}
          required
        />
        <button type="submit">Create Bookmark</button>
      </form>
    </div>
  );
};

export default Create;
