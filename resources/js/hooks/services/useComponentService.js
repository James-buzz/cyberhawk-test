import { useState } from "react";
import axios from "axios";

const useComponentService = () => {
    const [component, setComponent] = useState([]);
    const [components, setComponents] = useState([]);
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(false);

    const index = async (prefix = "") => {
        setLoading(true);
        setError(false);
        await axios
            .get(`/api/${prefix}components`)
            .then((res) => {
                setComponents(res.data.data);
            })
            .catch((err) => {
                setError(err);
            });
        setLoading(false);
    };

    const turbineComponents = async (turbineID) => {
        setLoading(true);
        await axios
            .get(`/api/turbines/${turbineID}/components`)
            .then((res) => {
                setComponent(res.data.data);
            })
            .catch((err) => {
                setError(err);
            });
        setLoading(false);
    };

    const show = async (componentID) => {
        setLoading(true);
        await axios
            .get(`/api/components/${componentID}`)
            .then((res) => {
                setComponent(res.data.data);
            })
            .catch((err) => {
                setError(err);
            });

        setLoading(false);
    };

    return {
        index,
        show,
        component,
        components,
        loading,
        error,
        turbineComponents,
    };
};
export default useComponentService;
