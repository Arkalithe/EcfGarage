import React, { createContext, useState } from 'react';


const AuthContext = createContext();

export const AuthProvider = ({ children }) => {
    const [id, setId] = useState(() => {
        return localStorage.getItem('authId');
    });

    const setAuthId = (newId) => {
        localStorage.setItem('authId', newId);
        setId(newId);
    };
    
    const logout = () => {
        localStorage.removeItem('authId');
        setId(null);
    };

    return (
        <AuthContext.Provider value={{ id, setAuthId, logout }}>
            {children}
        </AuthContext.Provider>
    );
};

export default AuthContext;