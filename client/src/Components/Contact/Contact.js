import React, { useRef, useState } from 'react';
import { Form, Button, Container, Row, Col, Card } from 'react-bootstrap';
import axios from 'axios';

const ContactPage = () => {
    const nameRef = useRef();

    const [mailSetting, setMailSetting] = useState({
        nom: '',
        prenom: '',
        email: '',
        phone: '',
        message: '',
    });

  
    const handleSubmit = async (e) => {
        e.preventDefault();
       

        try {
            const formData = new FormData();
            formData.append('nom', mailSetting.nom);
            formData.append('prenom', mailSetting.prenom);
            formData.append('email', mailSetting.email);
            formData.append('phone', mailSetting.phone);
            formData.append('message', mailSetting.message);

            await axios.post('https://localhost:8000/api/send-email', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                }
            },{ withCredentials: true });
            console.log(formData)
            alert('Email envoyé avec succès!');
        } catch (error) {
            console.error('Erreur lors de l\'envoi de l\'email :', error);
            alert('Échec de l\'envoi de l\'email. Veuillez réessayer plus tard.');
        }
    };

    const handleChange = (event) => {
        const { name, value } = event.target;
        setMailSetting({ ...mailSetting, [name]: value });
    };

    return (
        <Container className="voit">
            <div>
                <h3>Contactez-nous</h3>
            </div>
            <Row>
                <Col md={6} className="d-flex align-items-center">
                    <Form className="p-2 m-2" onSubmit={handleSubmit}>
                        <Form.Group>
                            <Form.Label>Nom:</Form.Label>
                            <Form.Control
                                type="text"
                                id="nom"
                                name="nom"
                                ref={nameRef}
                                autoComplete="off"
                                onChange={handleChange}
                                value={mailSetting.nom}
                                required
                            />
                        </Form.Group>

                        <Form.Group>
                            <Form.Label>Prénom:</Form.Label>
                            <Form.Control
                                type="text"
                                id="prenom"
                                name="prenom"
                                autoComplete="off"
                                onChange={handleChange}
                                value={mailSetting.prenom}
                                required
                            />
                        </Form.Group>

                        <Form.Group>
                            <Form.Label>Adresse e-mail:</Form.Label>
                            <Form.Control
                                type="email"
                                id="email"
                                name="email"
                                autoComplete="off"
                                onChange={handleChange}
                                value={mailSetting.email}
                                required
                            />
                        </Form.Group>

                        <Form.Group>
                            <Form.Label>Numéro de téléphone:</Form.Label>
                            <Form.Control
                                type="tel"
                                id="phone"
                                name="phone"
                                autoComplete="off"
                                onChange={handleChange}
                                value={mailSetting.phone}
                                required
                            />
                        </Form.Group>

                        <Form.Group>
                            <Form.Label>Message:</Form.Label>
                            <Form.Control
                                as="textarea"
                                id="message"
                                name="message"
                                autoComplete="off"
                                onChange={handleChange}
                                value={mailSetting.message}
                                required
                            />
                        </Form.Group>

                        <Button type="submit" variant="primary">
                            Envoyer Email
                        </Button>
                    </Form>
                </Col>
                <Col md={6} className="d-flex align-items-center justify-content-center">
                    <Card className="cadre-admin">
                        <Card.Body className="text-center">
                            <Card.Title>Informations de contact</Card.Title>
                            <Card.Text>
                                Numéro de téléphone : <strong>07-77-56-78-90</strong>
                            </Card.Text>
                            <Card.Text>
                                Adresse : <strong>26 Rue Richard Wagner, Toulouse, France</strong>
                            </Card.Text>
                        </Card.Body>
                    </Card>
                </Col>
            </Row>
        </Container>
    );
};

export default ContactPage;
