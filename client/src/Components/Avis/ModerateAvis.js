import React, { useState, useEffect } from "react";
import config from "../../api/axios";
import { Link } from "react-router-dom";
import { Card, Container } from "react-bootstrap";
import { Rating } from "@mui/material";

const ModerateAvis = () => {
  const [avis, setAvis] = useState([]);
  const [isLoading, setLoading] = useState(true);

  useEffect(() => {
    fetchAvis();
  }, []);

  const fetchAvis = async () => {
    try {
      const response = await config.herokuTesting.get("https://127.0.0.1:8000/api/avis");
      setAvis(response.data['hydra:member']);
      setLoading(false);
    } catch (error) {
      console.error("Error fetching avis:", error);
    }
  };

  if (isLoading) {
    return <div>Chargement...</div>;
  }

  const avist = avis.map((aviss) => {
    if (aviss.moderate === 0) {
      return (
        <Card className="voit d-flex flex-column container col-5 align-items-center my-3" key={aviss.id}>
          <Card.Body>
            <Card.Title>{aviss.nom}</Card.Title>
            <Card.Text>{aviss.message}</Card.Text>
            <Rating type="number" id="note" name="read-only" size="large" value={aviss.rating} readOnly />
            <Link className="align-self-center bouton lien" to={`/avis/${aviss.id}`}>
              Plus d'information
            </Link>
          </Card.Body>
        </Card>
      );
    } else {
      return null;
    }
  });

  return (
    <Container>
      <section className="d-flex flex-wrap justify-content-between">{avist}</section>
    </Container>
  );
};

export default ModerateAvis;
