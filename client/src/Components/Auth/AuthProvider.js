import React, { createContext, useState } from 'react';


const AuthContext = createContext();

export const AuthProvider = ({ children }) => {
    const [userRole, setUserRole] = useState('');
    const [isAuthenticated, setIsAuthenticated] = useState(false);
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState('');
  
    const login = async (credentials) => {
      setLoading(true);
      setError('');
      try {       
        const response = await fetch('https://localhost:8000/api/login', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          credentials: 'include', // 
          body: JSON.stringify(credentials),
        });
        if (!response.ok) throw new Error('Login failed');


        const data = await response.json();
        setUserRole(data.role);
        setIsAuthenticated(true);
        setLoading(false);
      } catch (err) {
        setError(err.message);
        setLoading(false);
      }
    };
  
    const logout = async () => {
      try {
        await fetch('https://localhost:8000/api/logout', {
          method: 'POST',
          credentials: 'include', 
        });

        setUserRole('');
        setIsAuthenticated(false);
      } catch (err) {
        console.error('Logout failed', err);
      }
    };

    return (
        <AuthContext.Provider value={{ login, logout, loading, error, userRole, isAuthenticated}}>
            {children}
        </AuthContext.Provider>
    );
};

export default AuthContext;