import { Navigate, Outlet, useLocation } from 'react-router-dom';
import { useContext, useEffect, useState } from 'react';
import {Spinner } from 'react-bootstrap';
import AuthContext from './AuthProvider';

const AuthRequire = ({ requiredRoles }) => {
    const location = useLocation();
    const { userRole, isAuthenticated } = useContext(AuthContext);
    const [isAuthorized, setIsAuthorized] = useState(false);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const checkPermissions = async () => {
            setLoading(true);
            try {

                const hasRequiredRole = requiredRoles.includes(userRole);
                setIsAuthorized(isAuthenticated && hasRequiredRole);
                setLoading(false);
            } catch (error) {
                console.error('Error permissions:', error)
                setLoading(false);
                setIsAuthorized(false);
            }
        };

        checkPermissions();
    }, [location, userRole, isAuthenticated, requiredRoles]);

    if (loading) {
        return  <Spinner animation="border" size="sm" /> 
    }
    
    if (!isAuthenticated) {
        return <Navigate to="/login" state={{ from: location }} replace />;
    }
    if (!isAuthorized) {
        return <Navigate to="/unauthorized" state={{ from: location }} replace />;
    }
    return <Outlet />;
}

export default AuthRequire;
