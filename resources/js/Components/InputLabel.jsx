export default function InputLabel({
    value,
    className = "",
    children,
    ...props
}) {
    return (
        <label {...props} className={`block mb-2 text-base` + className}>
            {value ? value : children}
        </label>
    );
}
