import React, { useState } from 'react';
import axios from 'axios';
import { Form, Button } from 'react-bootstrap';

const RegisterForm = () => {
    const [mail, setMail] = useState('');
    const [password, setPassword] = useState('');
    const [lastname, setLastname] = useState('');
    const [firstname, setFirstname] = useState('');
    const [roles, setRoles] = useState('');
    const [error, setError] = useState('');

    const handleSubmit = async (e) => {
        e.preventDefault();

        try {
            const response = await axios.post('https://localhost:8000/api/employes', {
                mail,
                password,
                lastname,
                firstname,
                roles
            }
            );
            console.log('Inscription réussie:', response.data);
        } catch (error) {
            console.error('Erreur lors de l\'inscription:', error);
            setError('Erreur lors de l\'enregistrement');
        }
    };

    return (
        <div className='bg-secondary p-4 rounded'>
            <h2>Inscription</h2>
            {error && <div style={{ color: 'red' }}>{error}</div>}
            <Form onSubmit={handleSubmit}>
                <Form.Group controlId="formBasicEmail">
                    <Form.Label>Email:</Form.Label>
                    <Form.Control
                        type="email"
                        value={mail}
                        onChange={(e) => setMail(e.target.value)}
                        required
                    />
                </Form.Group>
                <Form.Group controlId="formBasicPassword">
                    <Form.Label>Mot de passe:</Form.Label>
                    <Form.Control
                        type="password"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                        required
                    />
                </Form.Group>
                <Form.Group controlId="formBasicLastname">
                    <Form.Label>Nom:</Form.Label>
                    <Form.Control
                        type="text"
                        value={lastname}
                        onChange={(e) => setLastname(e.target.value)}
                        required
                    />
                </Form.Group>
                <Form.Group controlId="formBasicFirstname">
                    <Form.Label>Prénom:</Form.Label>
                    <Form.Control
                        type="text"
                        value={firstname}
                        onChange={(e) => setFirstname(e.target.value)}
                        required
                    />
                </Form.Group>
                <Form.Group controlId="formBasicRole">
                    <Form.Label>Rôle:</Form.Label>
                    <Form.Select
                        value={roles}
                        onChange={(e) => setRoles(e.target.value)}
                        required
                    >
                        <option value="Employe">Employe</option>
                        <option value="Admin">Admin</option>
                    </Form.Select>
                </Form.Group>
                <Button type="submit">S'inscrire</Button>
            </Form>
        </div>
    );
};

export default RegisterForm;
