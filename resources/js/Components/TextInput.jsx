import { forwardRef, useEffect, useRef } from "react";
import PropTypes from "prop-types";

export default forwardRef(function TextInput(
    {
        type = "text",
        name,
        value,
        defaultValue,
        className = "",
        variant = "primary",
        autoComplete,
        required,
        isFocused,
        handleChange,
        placeholder,
        isError,
        ...props
    },
    ref
) {
    const input = ref ? ref : useRef();

    useEffect(() => {
        if (isFocused) {
            input.current.focus();
        }
    }, []);

    return (
        <input
            {...props}
            type={type}
            className={`rounded-2xl bg-form-bg py-[13px] px-7 w-full ${
                isError && "input-error"
            } input-${variant} ${className}`}
            name={name}
            value={value}
            autoComplete={autoComplete}
            ref={input}
            defaultValue={defaultValue}
            placeholder={placeholder}
        />
    );

    TextInput.propTypes = {
        type: PropTypes.oneOf(["text", "email", "password", "number", "file"]),
        name: PropTypes.string,
        value: PropTypes.oneOfType([PropTypes.string, PropTypes.number]),
        defaultValue: PropTypes.oneOfType([PropTypes.string, PropTypes.number]),
        className: PropTypes.string,
        variant: PropTypes.oneOf(["primary", "error", "primary-outline"]),
        autoComplete: PropTypes.string,
        required: PropTypes.bool,
        isFocused: PropTypes.bool,
        handleChange: PropTypes.func,
        placeholder: PropTypes.string,
        isError: PropTypes.bool,
    };
});
