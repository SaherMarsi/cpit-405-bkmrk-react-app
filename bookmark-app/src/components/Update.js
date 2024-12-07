import { useState } from "react";

const Update = () => {
    const [id, setId] = useState("");
    const [title, setTitle] = useState("");
    const [urls, setUrls] = useState("");

    const handleSubmit = async () => {
        const data = { id, title, urls };
        try {
            const response = await fetch("/api/update.php", {
                method: "PUT",
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
            <h2>Update a bookmark!</h2>
            <form onSubmit={handleSubmit}>
                <input
                    type="text"
                    placeholder="ID"
                    value={id}
                    onChange={(e) => setId(e.target.value)}
                    required
                />
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
                <button type="submit" id="update">Update</button>
            </form>
        </div>
    );
};

export default Update;
