import React, { useState, useEffect } from "react";
import axios from 'axios';
import { Link, useParams } from "react-router-dom";
import { Container, Form, Button, Row, Col } from 'react-bootstrap';
import { Checkbox } from "@mui/material";

const GetEmploye = () => {
    const [employes, setEmployes] = useState([]);
    const [idEmployes, setIdEmployes] = useState([]);
    const { idEmploye } = useParams();

    const handleCheckBoxChange = (event, id) => {
        if (event.target.checked) {
            setIdEmployes((prevId) => [...prevId, id]);
        } else {
            setIdEmployes((prevId) => prevId.filter((idEmploye) => idEmploye !== id));
        }
    }

    const fetchEmploye = async () => {
        try {
            const response = await axios.get('https://127.0.0.1:8000/api/employes', { withCredentials: true });
            setEmployes(response.data['hydra:member']);            
        } catch (error) {
        }
    }

    const deleteEmploye = async () => {
        try {
            const filtreEmployes = idEmployes.filter((id) => {
                const employe = employes.find((employe) => employe.id === id);
                return employe.role !== "Admin";
            });

            await Promise.all(filtreEmployes.map(async (id) => {
               const response = await axios.delete(`https://localhost:8000/api/employes/${id}`, { withCredentials: true });
               console.log("Réponse du serveur :", response.data);
            }));
            
            fetchEmploye();
            setIdEmployes([]);
        } catch (error) {

        }
    }
    useEffect(() => {
        fetchEmploye();
    }, []);

    if (employes.length === 0) {
        return <div>Loading...</div>;
    }

    const employesFormat = employes.map((employe) => (
        <Row key={employe.id} className="align-items-center">
            <Col>
                <Checkbox
                    checked={idEmployes.includes(employe.id)}
                    onChange={(e) => handleCheckBoxChange(e, employe.id)}
                />
            </Col>
            <Col>
                <Link to={`/employe/update/${employe.id}`}>
                    <div >Id: {employe.id}</div>
                    <div >Email: {employe.mail}</div>
                </Link>
            </Col>
        </Row>
    ));

    return (
        <Container>
            <h3>Liste Employe</h3>
            {employesFormat}

            {idEmployes.length > 0 && (
                <Button style={{ backgroundColor: "#FF5733", borderColor: "#FF5733" }} onClick={deleteEmploye}>
                    Supprimer
                </Button>
            )}

            <Button style={{ backgroundColor: "#FFf", borderColor: "#FFf" }} ><Link to="/signup">
                Ajouter
            </Link></Button>
        </Container>
    )
}

export default GetEmploye;
