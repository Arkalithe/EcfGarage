import React from 'react';
import { Link } from 'react-router-dom';
import { Container, Row, Col, Button } from 'react-bootstrap';

const AdminSpace = () => {
  return (
    <div className='form-cadre p-1'>
      <Container>
        <Row className='justify-content-center'>

          <Col lg={5} md={5} sm={12} className='d-flex flex-column align-items-center cadre m-1'>
            <h3>Gestion Employé</h3>
            <Link to='/employes'>
              <Button className='bouton bouton-lien'>Modifié</Button>
            </Link>
          </Col>

          <Col lg={5} md={5} sm={12} className='d-flex flex-column align-items-center cadre m-1'>
            <h3>Gestion Horaire</h3>
            <Link to='/horaires'>
              <Button className='bouton bouton-lien'>Modifié</Button>
            </Link>
          </Col>+
        </Row>

        <Row className='justify-content-center'>
          <Col lg={5} md={5} sm={12} className='d-flex flex-column align-items-center cadre m-1'>
            <h3>Moderation avis</h3>
            <Link to='/avis'>
              <Button className='bouton bouton-lien'>Modifié</Button>
            </Link>
          </Col>

          <Col lg={5} md={5} sm={12} className='d-flex flex-column align-items-center cadre m-1'>
            <h3>Creation Voiture</h3>
            <Link to='/creationVoiture'>
              <Button className='bouton bouton-lien'>Modifié</Button>
            </Link>
          </Col>
        </Row>

        <Row className='justify-content-center'>
          <Col lg={5} md={5} sm={12} className='d-flex flex-column align-items-center cadre-admin m-1'>
            <h3>Moderation Voiture</h3>
            <Link to='/updateVoiture'>
              <Button className='bouton bouton-lien'>Modifié</Button>
            </Link>
          </Col>

          <Col lg={5} md={5} sm={12} className='d-flex flex-column align-items-center cadre-admin m-1'>
            <h3>Moderation Contenue</h3>
            <Link to='/contentSpace'>
              <Button className='bouton bouton-lien'>Modifié</Button>
            </Link>
          </Col>
        </Row>
      </Container>
    </div>
  );
};

export default AdminSpace;
