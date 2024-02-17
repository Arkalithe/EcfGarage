import React from 'react';
import { Navbar, Nav, Container } from 'react-bootstrap';
import { Link } from 'react-router-dom';
import AuthUse from '../Auth/AuthUse';

const Header = () => {
    const { role, logout } = AuthUse();

    return (
        <>
            {/* Barre de navigation pour les écrans de taille moyenne (et plus) */}
            <Navbar bg="dark" variant="dark" expand="md" fixed='top' className="d-none d-md-block">
                <Container>
                    <Navbar.Brand as={Link} to="/" style={{ marginRight: 'auto' }}>Mon Application</Navbar.Brand>
                    <Nav className="ml-auto">
                        <Nav.Link as={Link} to="/">Accueil</Nav.Link>
                        <Nav.Link as={Link} to="/about">À propos</Nav.Link>
                        <Nav.Link as={Link} to="/contact">Contact</Nav.Link>
                        {role ? (
                            <>
                                {role === 'employé' && <Nav.Link as={Link} to="/employee">Espace Employé</Nav.Link>}
                                {role === 'admin' && <Nav.Link as={Link} to="/admin">Espace Admin</Nav.Link>}
                                <Nav.Link onClick={logout}>Logout</Nav.Link>
                            </>
                        ) : (
                            <Nav.Link as={Link} to="/login">Login</Nav.Link>
                        )}
                    </Nav>
                </Container>
            </Navbar>


            <div className="d-md-none"> 
                <Navbar bg="dark" variant="dark" fixed='top'>
                <Navbar.Brand as={Link} to="/" style={{ marginRight: 'auto' }}>Mon Application</Navbar.Brand>

                        <Nav className="mr-auto">
                            <Nav.Link as={Link} to="/">Accueil</Nav.Link>
                            <Nav.Link as={Link} to="/about">À propos</Nav.Link>
                            <Nav.Link as={Link} to="/contact">Contact</Nav.Link>
                            {role ? (
                                <>
                                    {role === 'employé' && <Nav.Link as={Link} to="/employee">Espace Employé</Nav.Link>}
                                    {role === 'admin' && <Nav.Link as={Link} to="/admin">Espace Admin</Nav.Link>}
                                    <Nav.Link onClick={logout}>Logout</Nav.Link>
                                </>
                            ) : (
                                <Nav.Link as={Link} to="/login">Login</Nav.Link>
                            )}
                        </Nav>
                    
                </Navbar>
            </div>
        </>
    );
};

export default Header;
