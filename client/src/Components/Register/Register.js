import React, { useState } from 'react';
import axios from 'axios';

const RegisterForm = () => {
    const [mail, setMail] = useState('');
    const [password, setPassword] = useState('');
    const [lastname, setLastname] = useState('');
    const [firstname, setFirstname] = useState('');
    const [roles, setRoles] = useState([]);
    const [error, setError] = useState('');

    const handleSubmit = async (e) => {
        e.preventDefault();

        try {
            const response = await axios.post('http://127.0.0.1:8000/api/employes/add', {
                mail,
                password,
                lastname,
                firstname,
                roles: roles
            });
            console.log('Registration successful:', response.data);
        } catch (error) {
            console.error('Registration error:', error);
            setError('Erreur lors de l\'enregistrement');
        }
    };


    return (
        <div>
            <h2>Inscription</h2>
            {error && <div style={{ color: 'red' }}>{error}</div>}
            <form onSubmit={handleSubmit}>
                <div>
                    <label>Email:</label>
                    <input
                        type="email"
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
                <div>
                    <label>Lastname:</label>
                    <input
                        type="text"
                        value={lastname}
                        onChange={(e) => setLastname(e.target.value)}
                        required
                    />
                </div>
                <div>
                    <label>Firstname:</label>
                    <input
                        type="text"
                        value={firstname}
                        onChange={(e) => setFirstname(e.target.value)}
                        required
                    />
                </div>
                <div>
                    <label>Role:</label>
                    <input
                        type="text"
                        value={roles.join(',')} 
                        onChange={(e) => setRoles(e.target.value.split(',').map(role => role.trim()))}
                        required
                    />
                </div>
                <button type="submit">S'inscrire</button>
            </form>
        </div>
    );
};

export default RegisterForm;
