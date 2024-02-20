import { Navigate, Outlet, useLocation } from "react-router-dom";
import AuthUse from "./AuthUse";

const AuthRequire = ({ role }) => {
    const { role: authRole } = AuthUse();
    const location = useLocation();
    if (!authRole) {
        return <Navigate to="/login" state={{ from: location }} replace />;
    }
    if (!role.includes(authRole)) {
        return <Navigate to="/unauthorized" state={{ from: location }} replace />;
    }
    return <Outlet />;
}

export default AuthRequire;
