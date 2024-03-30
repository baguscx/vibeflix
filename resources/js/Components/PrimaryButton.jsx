import PropTypes from "prop-types";

export default function PrimaryButton({
    className = "",
    variant,
    disabled,
    children,
    ...props
}) {
    return (
        <button
            {...props}
            className={`rounded-2xl py-[13px] text-center w-full btn-${variant} ${className}`}
            disabled={disabled}
        >
            {children}
        </button>
    );

    PrimaryButton.propTypes = {
        type: PropTypes.oneOf(["button", "submit", "reset"]),
        className: PropTypes.string,
        variant: PropTypes.oneOf([
            "primary",
            "warning",
            "danger",
            "light-outline",
            "white-outline",
        ]),
        disabled: PropTypes.bool,
        children: PropTypes.node,
    };
}
