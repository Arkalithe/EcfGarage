import React, { useState } from 'react';
import axios from 'axios';
import AuthUse from '../Auth/AuthUse';

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
    <div>
      <h2>Login</h2>
      {error && <div style={{ color: 'red' }}>{error}</div>}
      <form onSubmit={handleSubmit}>
        <div>
          <label>Email:</label>
          <input
            type="mail"
            value={mail}
            onChange={(e) => setMail(e.target.value)}
            required
          />
        </div>
        <div>
          <label>Password:</label>
          <input
            type="password"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
            required
          />
        </div>
        <button type="submit">Login</button>
      </form>
    </div>
  );
};

export default LoginForm;