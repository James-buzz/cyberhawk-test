import { useState } from "react";
import axios from "axios";

const useGradeService = () => {
    const [grade, setGrade] = useState([]);
    const [grades, setGrades] = useState([]);
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(false);

    const index = async (prefix = "") => {
        setLoading(true);
        setError(false);
        await axios
            .get(`/api/${prefix}grades`)
            .then((res) => {
                setGrades(res.data.data);
            })
            .catch((err) => {
                setError(err);
            });
        setLoading(false);
    };

    const show = async (gradeID) => {
        setLoading(true);
        await axios
            .get(`/api/grades/${gradeID}`)
            .then((res) => {
                setGrade(res.data);
            })
            .catch((err) => {
                setError(err);
            });

        setLoading(false);
    };

    return { index, show, grade, grades, loading, error };
};
export default useGradeService;
