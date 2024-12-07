import { useState } from "react";

const Delete = () => {
    const [id, setId] = useState("");

    const handleSubmit = async () => {
        try {
            const response = await fetch("/api/delete.php", {
                method: "DELETE",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({id})
            });
            const responseJSON = await response.json();
            console.log(responseJSON.message);
        } catch (error) {
            console.log("Error:", error);
        }
    };

    return (
        <div className="search-container">
            <h2>Delete a bookmark!</h2>
            <form onClick={handleSubmit}>
                <input
                    type="text"
                    placeholder="ID"
                    value={id}
                    onChange={(e) => setId(e.target.value)}
                    required
                />
                <button id="delete">Delete bookmark</button>
            </form>
        </div>
    );
};

export default Delete;
