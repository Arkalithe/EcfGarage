import React from 'react';
import { Link } from 'react-router-dom';
import { Container, Row, Col, Card, Button } from 'react-bootstrap';

const ContentSpace = () => {
    return (
        <div className='form-cadre p-1'>
            <Container>
                <Row className='justify-content-center'>
                    <Col lg={5} md={5} sm={12} className='m-1'>
                        <Card className='cadre-admin'>
                            <Card.Body className='d-flex flex-column align-items-center'>
                                <Card.Title>Gestion Depannage</Card.Title>
                                <Link to='/editDepanage'>
                                    <Button variant='primary'>Modifié</Button>
                                </Link>
                            </Card.Body>
                        </Card>
                    </Col>
                    <Col lg={5} md={5} sm={12} className='m-1'>
                        <Card className='cadre-admin'>
                            <Card.Body className='d-flex flex-column align-items-center'>
                                <Card.Title>Gestion Repartion</Card.Title>
                                <Link to='/editReparation'>
                                    <Button variant='primary'>Modifié</Button>
                                </Link>
                            </Card.Body>
                        </Card>
                    </Col>
                </Row>
                <Row className='justify-content-center'>
                    <Col lg={5} md={5} sm={12} className='m-1'>
                        <Card className='cadre-admin'>
                            <Card.Body className='d-flex flex-column align-items-center'>
                                <Card.Title>Gestion Ocasion</Card.Title>
                                <Link to='/editOcasion'>
                                    <Button variant='primary'>Modifié</Button>
                                </Link>
                            </Card.Body>
                        </Card>
                    </Col>
                </Row>
            </Container>
        </div>
    );
};

export default ContentSpace;
