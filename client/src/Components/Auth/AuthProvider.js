import React, { createContext, useState, useEffect } from 'react';
import { jwtDecode } from 'jwt-decode';

const AuthContext = createContext();

const getRoleFromToken = (token) => {
    if (token) {
        const decodedToken = jwtDecode(token);
        const currentTime = Date.now() / 1000;
        if (decodedToken.exp && decodedToken.exp > currentTime) {
            return decodedToken.role;
        }
    }
    return null;
};

export const AuthProvider = ({ children }) => {
    const [role, setRole] = useState(() => {
        const initialToken = localStorage.getItem('authToken');
        return getRoleFromToken(initialToken);
    });

    const setAuthToken = (newToken) => {
        localStorage.setItem('authToken', newToken);
        const newRole = getRoleFromToken(newToken);
        setRole(newRole);
    };

    useEffect(() => {
        if (!role) {
            localStorage.removeItem("authToken")
        }
        console.log('Role actuel :', role);
    }, [role]);
    
    const logout = () => {
        localStorage.removeItem('authToken');
        setAuthToken(null);
        setRole(null)
    };

    console.log('Token actuel :', role);
    return (
        <AuthContext.Provider value={{ role, setAuthToken, logout }}>
            {children}
        </AuthContext.Provider>
    );
};

export default AuthContext;