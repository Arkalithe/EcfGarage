
import React, { useEffect, useState, useCallback } from 'react';
import { useParams } from 'react-router';
import { Container, Form, Button } from 'react-bootstrap';
import axios from 'axios';

export const UpdateEmploye = () => {
    const [isLoading, setLoading] = useState(true);
    const [id, setId] = useState("");
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [role, setRole] = useState("");
    const [firstname, setFirstname] = useState("");
    const [lastname, setLastname] = useState("");
    const { idEmploye } = useParams();

    const fetchEmploye = useCallback(async () => {
        try {
            const response = await axios.get(`https://localhost:8000/api/employes/${idEmploye}`);
            setId(response.data.id);
            console.log(response.data)
            setEmail(response.data.email);
            setPassword(response.data.password);
            setRole(response.data.role);
            setLastname(response.data.lastname);
            setFirstname(response.data.firstname);
            setLoading(false);
        } catch (err) {
            if (err.response) {

            } else if (err.request) {

            } else {

            }
        }
    }, [idEmploye]);

    useEffect(() => {
        fetchEmploye();
    }, [fetchEmploye]);

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            await axios.put(`https://localhost:8000/api/employes/${id}`,({ id, email, password, role, lastname, firstname }));
        } catch (err) {
        }
    };

 

    if (isLoading) {
        return <div>Chargement</div>;
    }

    return (
        <Container>
  
                <Form className="container form-cadre d-flex flex-column align-items-center" onSubmit={handleSubmit}>
                    <Form.Group controlId="email">
                        <Form.Label>Email:</Form.Label>
                        <Form.Control type="text" value={email} onChange={(e) => setEmail(e.target.value)} />
                    </Form.Group>

                    <Form.Group controlId="password">
                        <Form.Label>Password:</Form.Label>
                        <Form.Control type="password" value={password} onChange={(e) => setPassword(e.target.value)} />
                    </Form.Group>

                    <Form.Group controlId="role">
                        <Form.Label>Role:</Form.Label>
                        <Form.Control type="text" value={role} onChange={(e) => setRole(e.target.value)} />
                    </Form.Group>

                    <Form.Group controlId="firstname">
                        <Form.Label>Firstname:</Form.Label>
                        <Form.Control type="text" value={firstname} onChange={(e) => setFirstname(e.target.value)} />
                    </Form.Group>

                    <Form.Group controlId="lastname">
                        <Form.Label>Lastname:</Form.Label>
                        <Form.Control type="text" value={lastname} onChange={(e) => setLastname(e.target.value)} />
                    </Form.Group>

                    <Button variant="primary" type="submit">Envoyer</Button>
                </Form>
            
            
        </Container>
    );
};

export default UpdateEmploye;
