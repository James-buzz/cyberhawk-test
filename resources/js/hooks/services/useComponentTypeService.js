import { useState } from "react";
import axios from "axios";

const useComponentTypeService = () => {
    const [componentType, setComponentType] = useState([]);
    const [componentTypes, setComponentTypes] = useState([]);
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(false);

    const index = async (prefix = "") => {
        setLoading(true);
        setError(false);
        await axios
            .get(`/api/${prefix}component-types`)
            .then((res) => {
                setComponentTypes(res.data.data);
            })
            .catch((err) => {
                setError(err);
            });
        setLoading(false);
    };

    const show = async (componentTypeID) => {
        setLoading(true);
        await axios
            .get(`/api/component-types/${componentTypeID}`)
            .then((res) => {
                setComponentType(res.data);
            })
            .catch((err) => {
                setError(err);
            });

        setLoading(false);
    };

    return { index, show, componentType, componentTypes, loading, error };
};
export default useComponentTypeService;
