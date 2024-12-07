import { useState, useEffect } from "react";

const ReadAll = () => {
    const [bkmrks, setBkmrks] = useState([]);
    useEffect(() => {
        const fetchBkmrks = async () => {
            try {
                const response = await fetch("/api/readAll.php");
                const responseJSON = await response.json();
                if (Array.isArray(responseJSON)) {
                    setBkmrks(responseJSON);
                }
            } catch (error) {
                console.log("Error:", error);
            }
        };
        fetchBkmrks();
    }, [])

    return (
        <div className="search-container">
            <h2>My bookmarks</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>TITLE</th>
                    <th>URL</th>
                    <th>DATE</th>
                </tr>
                {bkmrks.map((bkmrks) => ( // using map really helped here!
                    <tr>
                        <td>{bkmrks.id}</td>
                        <td>{bkmrks.title}</td>
                        <td>{bkmrks.urls}</td>
                        <td>{bkmrks.date_added}</td>
                    </tr>
                ))}
            </table>
        </div>
    );
};

export default ReadAll;
