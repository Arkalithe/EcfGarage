import React, { createContext, useState } from 'react';


const AuthContext = createContext();

export const AuthProvider = ({ children }) => {
    const [id, setId] = useState(() => localStorage.getItem('authId'));
    const [role, setRole] = useState(() => {
        return localStorage.getItem('authRole');
    });

    const setAuthId = (newId) => {
        localStorage.setItem('authId', newId);
        setId(newId);
    };
    const setAuthRole = (newRole) => {
        localStorage.setItem('authRole', newRole);
        setRole(newRole);
    };
    const logout = () => {
        localStorage.removeItem('authId');
        localStorage.removeItem('authRole');
        setId(null);
        setRole(null);
    };

    return (
        <AuthContext.Provider value={{ id, role, setAuthRole, setAuthId, logout }}>
            {children}
        </AuthContext.Provider>
    );
};

export default AuthContext;