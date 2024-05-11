import React, { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import config from "../../api/axios";
import { Container, Button, Card } from "react-bootstrap";
import { Rating } from "@mui/material";

const SingleAvis = () => {
    const updateAvis_url = "/Api/Avis/AvisUpdate.php";

    const [isLoading, setLoading] = useState(true);
    const [avis, setAvis] = useState([]);
    const { id } = useParams();

    useEffect(() => {
        fetchAvis();
    }, []);

    const fetchAvis = async () => {
        try {
            const response = await config.herokuTesting.get(`https://localhost:8000/api/employes/${id}`);
            setAvis(response.data);
            setLoading(false);
        } catch (error) {
            console.error("Error fetching avis:", error);
        }
    };

    const handleDelete = async () => {
        try {
            await config.herokuTesting.delete(`https://localhost:8000/api/employes/${id}`);
        } catch (error) {
            console.error("Error deleting avis:", error);
        }
    };

    const handleUpdate = async () => {
        try {
            const updatedAvis = {
                id: id,
                moderate: 1,
                rating: avis.rating,
                message: avis.message,
                nom: avis.nom
            };

            await config.herokuTesting.post(`https://localhost:8000/api/employes/${id}`, updatedAvis );
            setAvis(prevAvis => ({ ...prevAvis, moderate: 1}));
        } catch (error) {
            console.error("Error updating avis:", error);
        }
    };

    if (isLoading) {
        return <div>Chargement...</div>;
    }

    return (
        <Container>
            <Card className="voit container align-items-center">
                <Card.Body className="d-flex flex-column align-items-center">
                    <Card.Title className="my-2">{avis.nom}</Card.Title>
                    <Card.Text className="my-2">{avis.message}</Card.Text>
                    <Rating
                        className="my-2"
                        type="number"
                        id="note"
                        name="read-only"
                        size="large"
                        value={avis.rating}
                        readOnly
                    />
                    <div>
                        <Button variant="primary" className="mx-4" onClick={handleUpdate}>Autoriser</Button>
                        <Button variant="danger" className="mx-4" onClick={handleDelete}>Supprimer</Button>
                    </div>
                </Card.Body>
            </Card>
        </Container>
    );
};

export default SingleAvis;
