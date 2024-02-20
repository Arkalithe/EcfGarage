import React, { useEffect, useState } from 'react';
import { Container, Form, Button, Row, Col } from 'react-bootstrap';
import axios from 'axios';

const HoraireUpdate = () => {
    const apiUrl = 'https://localhost:8000/api/horaires';
    const [businessHours, setBusinessHours] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        fetchBusinessHours();
    }, []);

    const fetchBusinessHours = async () => {
        try {
            const response = await axios.get(apiUrl, { withCredentials: true });
            console.log('Business Hours from API:', response.data);
            setBusinessHours(response.data);
            setLoading(false);
        } catch (error) {
            console.error('Error:', error);
            setError(error);
            setLoading(false);
        }
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            console.log('Submitting updated business hours:', businessHours);
            await axios.put(apiUrl, businessHours, { withCredentials: true });
        } catch (error) {
            console.error('Error:', error);
        }
    };

    const handleInputChange = (e, index, key) => {
        const updatedHours = [...businessHours];
        updatedHours[index] = {
            ...updatedHours[index],
            [key]: e.target.value,
        };
        console.log('Updated business hours:', updatedHours);
        setBusinessHours(updatedHours);
    };

    if (loading) {
        return <div>Loading...</div>;
    }

    if (error) {
        return <div>Error: {error.message}</div>;
    }

    if (businessHours.length === 0) {
        return <div>No business hours found in the database.</div>;
    }

    return (
        <Container fluid className='p-1 my-3 form-cadre'>
            <h3>Modifé Horaire</h3>
            <Form onSubmit={handleSubmit}>
                {Array.isArray(businessHours) && businessHours.map((hour, index) => (
                    <Container fluid className="mb-3" key={hour.id}>
                         {businessHours.map((hour, index) => (
                    <Container fluid className="mb-3" key={hour.id}>
                        <Row className="align-items-center">
                            <Col xs={3}>
                                <div className="d-flex align-items-center">
                                    <Form.Label className="mb-0">{hour.jour}:</Form.Label>
                                </div>
                            </Col>
                            <Col>
                                <Row className="align-items-center">
                                    <Col xs={4}>
                                        <p className="pl-1">Matin:</p>
                                    </Col>
                                    <Col>
                                        <Form.Control
                                            type='text'
                                            value={hour.matin}
                                            onChange={(e) => handleInputChange(e, index, 'matin')}
                                        />
                                    </Col>
                                </Row>
                                <Row className="align-items-center">
                                    <Col xs={4}>
                                        <p>Apresmidi:</p>
                                    </Col>
                                    <Col>
                                        <Form.Control
                                            type='text'
                                            value={hour.apresmidi}
                                            onChange={(e) => handleInputChange(e, index, 'apresmidi')}
                                        />
                                    </Col>
                                </Row>
                            </Col>
                        </Row>
                    </Container>
                ))}
                    </Container>
                ))}
               
                <Button className='bouton' type="submit">Envoyez</Button>
            </Form>
        </Container>
    );
};

export default HoraireUpdate;
