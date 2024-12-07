import { useState } from "react";

const ReadOne = () => {
    const [id, setId] = useState("");
    const [title, setTitle] = useState("");
    const [urls, setUrls] = useState("");
    const [date, setDate] = useState("");

    const handleSubmit = async () => {
        try {
            const response = await fetch(`/api/readOne.php?id=${id}`);
            const responseJSON = await response.json();
            if (responseJSON.id) {
                setUrls(responseJSON.urls)
                setTitle(responseJSON.title)
                setDate(responseJSON.dateAdded)
            }
        } catch (error) {
            console.log("Error:", error);
        }
    };

    return (
        <div className="search-container">
            <h2>Search for a bookmark!</h2>

            <input
                type="text"
                placeholder="Enter the bookmark's ID please!"
                value={id}
                onChange={(x) => setId(x.target.value)}
            />

            <button onClick={handleSubmit}>Find bookmark</button>
            <table>
                <tr>
                    <th>ID</th>
                    <th>TITLE</th>
                    <th>URL</th>
                    <th>DATE</th>
                </tr>
                <tr>
                    <td>{id}</td>
                    <td>{title}</td>
                    <td>{urls}</td>
                    <td>{date}</td>
                </tr>
            </table>

        </div>
    );
};

export default ReadOne;
