import React, { useState } from 'react';
import axios from 'axios';
import AuthUse from '../Auth/AuthUse';
import { Container, Form, Button } from 'react-bootstrap';


const LoginForm = () => {
  const { setAuthToken } = AuthUse();
  const [mail, setMail] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');

  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const response = await axios.post('http://127.0.0.1:8000/api/login', { mail, password }, { withCredentials: true });
      const {token} = response.data;
      setAuthToken(token);
      console.log('Login successful:', response.data);
    } catch (error) {
      console.error('Login error:', error);
      setError('Identifiants invalides');
    }
  };

  return (
    <>
    <h2 className="mb-4">Connexion</h2>
    {error && <div className="text-danger mb-3">{error}</div>}
    <Form onSubmit={handleSubmit}>
      <Form.Group controlId="formBasicEmail" className="mb-3">
        <Form.Label>Email:</Form.Label>
        <Form.Control
          type="email"
          value={mail}
          onChange={(e) => setMail(e.target.value)}
          placeholder="Enter email"
          required
        />
      </Form.Group>
      <Form.Group controlId="formBasicPassword" className="mb-3">
        <Form.Label>Password:</Form.Label>
        <Form.Control
          type="password"
          value={password}
          onChange={(e) => setPassword(e.target.value)}
          placeholder="Password"
          required
        />
      </Form.Group>
      <Button variant="primary" type="submit">
        Login
      </Button>
    </Form>
  </>
  );
};

export default LoginForm;