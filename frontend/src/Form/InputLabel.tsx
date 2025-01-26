import React from 'react';

type Props = {
  label: string;
  htmlFor: string | undefined;
};

const InputLabel: React.FC<Props> = ({ label, htmlFor = undefined, ...rest }) => {
  return (
    <>
      <label className="input-label" htmlFor={htmlFor} {...rest}>
        {label}
      </label>
    </>
  );
};

export default InputLabel;
