import React, { useState } from 'react';
import axios from 'axios';
import AuthUse from '../Auth/AuthUse';
import { Form, Button, Spinner } from 'react-bootstrap';
import { useNavigate } from 'react-router-dom';


const LoginForm = () => {
  const { setAuthId, setAuthRole } = AuthUse();
  const [mail, setMail] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');
  const [loading, setLoading] = useState(false);
  const navigate = useNavigate();

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError('');
    setLoading(true);

    try {      
      const response = await axios.post('https://localhost:8000/api/login',
        { mail, password },
        { withCredentials: true }
      );

      const { id, role } = response.data;
      setAuthId(id);
      setAuthRole(role);
      navigate("/home")
      window.location.reload()   
      
    } catch (error) {
      if (error.response && error.response.status === 401) {
        setError('Identifiants invalides');
      } else {
        setError('Erreur de service. Veuillez réessayer plus tard.');
      }
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className='bg-secondary p-4 rounded '>
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
        {loading ? <Spinner animation="border" size="sm" /> : 'Login'}
        </Button>
      </Form>
    </div>
  );
};

export default LoginForm;