import React, { useState, useEffect } from 'react';
import { Navigate, Outlet, useLocation } from "react-router-dom";
import AuthUse from "./AuthUse";
import axios from 'axios';

const AuthRequire = ({ role }) => {
    const { auth } = AuthUse();
    const location = useLocation();
    const [employesRole, setEmployesRole] = useState(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const fetchUserRole = async () => {
            try {
                if (auth && auth.id) {
                    const response = await axios.get(`https://localhost:8000/api//employes/${auth.id}` , {
                        params : {
                            id: auth.id
                        }
                    }, { withCredentials: true })
                    ;
                    setEmployesRole(response.data.role);
                    console.log(response.data.role)
                    setLoading(false);
                } else {
                    setLoading(false);
                }
            } catch (error) {
                console.error('Erreur lors de la récupération du rôle:', error);
                setLoading(false);
            }
        };

        if (!auth || !employesRole) {
            fetchUserRole();
        }
    }, [auth, employesRole]);

    if (!auth || !auth.role) {
        return <Navigate to="/login" state={{ from: location }} replace />;
    }
    if (!role.includes(auth.role)) {
        return <Navigate to="/unauthorized" state={{ from: location }} replace />;
    }
    return <Outlet />;
}

export default AuthRequire;
