import React, { useState, useEffect } from "react";
import axios from "axios";
import { Card, Container } from "react-bootstrap";
import { Rating } from "@mui/material";

const GetAvis = () => {
    const [avis, setAvis] = useState([]);

    useEffect(() => {
        fetchAvis();
    }, []);

    const fetchAvis = async () => {
        try {
            const response = await axios.get("https://127.0.0.1:8000/api/avis", { withCredentials: true });
            const filteredData = response.data['hydra:member'].filter(aviss => aviss.moderate === 1);
            const shuffledData = filteredData.sort(() => Math.random() - 0.5);
            setAvis(shuffledData.slice(0, 4));
        } catch (error) {
            console.error("Error fetching avis:", error);
        }
    };

    const avist = avis.map((aviss) => (
        <Container >
        <Card className="m-3" key={aviss.id}>
            <Card.Body>
                <Card.Title>{aviss.nom}</Card.Title>
                <Card.Text>{aviss.message}</Card.Text>
                <Rating
                        type="number"
                        id="note"
                        name="read-only"
                        size="large"
                        value={aviss.rating}
                        readOnly
                    />
            </Card.Body>
        </Card>
        </Container>
    ));

    return (
        <Container>
            <div className="d-flex flex-wrap justify-content-between">
                {avist}
            </div>
        </Container>
    );
};

export default GetAvis;
